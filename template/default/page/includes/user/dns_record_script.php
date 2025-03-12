<script>
const serverIPs = <?= json_encode($server_ips) ?>;
const domain = '<?= $domain ?>';

const recordTypes = {
    'A': {
        contentLabel: 'IPv4 Address',
        contentPlaceholder: 'Enter IP address',
        showProxy: true,
        showIpSuggestions: true,
        inputType: 'text'
    },
    'AAAA': {
        contentLabel: 'IPv6 Address', 
        contentPlaceholder: 'Enter IPv6 address',
        showProxy: true,
        showIpSuggestions: false,
        inputType: 'text'
    },
    'CNAME': {
        contentLabel: 'Target Domain',
        contentPlaceholder: 'E.g. www.example.com',
        showProxy: true,
        showIpSuggestions: false,
        inputType: 'text'
    },
    'MX': {
        contentLabel: 'Mail Server',
        contentPlaceholder: 'E.g. mail.example.com',
        showProxy: false,
        showIpSuggestions: false,
        inputType: 'text',
        extraField: {
            name: 'priority',
            label: 'Priority',
            type: 'number',
            required: true,
            min: 0,
            max: 65535,
            defaultValue: 10
        }
    },
    'TXT': {
        contentLabel: 'TXT Content',
        contentPlaceholder: 'Enter text content',
        showProxy: false,
        showIpSuggestions: false,
        inputType: 'textarea'
    }
};

function updateRecordForm(type) {
    const config = recordTypes[type];
    const proxyField = document.getElementById('proxy-field');
    const extraFields = document.getElementById('extra-fields');
    const container = document.getElementById('content-container');

    // Update content field
    container.innerHTML = `
        <div class="mb-3">
            <label class="form-label">${config.contentLabel}</label>
            <div class="position-relative">
                ${config.inputType === 'textarea' ? 
                    `<textarea name="content" id="add_content" 
                             class="form-control" rows="4" required
                             placeholder="${config.contentPlaceholder}"></textarea>` :
                    `<input type="text" name="content" id="add_content" 
                            class="form-control" required
                            placeholder="${config.contentPlaceholder}"
                            ${config.showIpSuggestions ? 'autocomplete="off"' : ''}>`
                }
                ${config.showIpSuggestions ? 
                    `<div id="ipSuggestions" class="position-absolute w-100 mt-1 shadow-sm d-none"></div>` : 
                    ''
                }
            </div>
        </div>
    `;

    // Show/hide proxy toggle
    proxyField.style.display = config.showProxy ? 'block' : 'none';

    // Handle extra fields
    if(config.extraField) {
        const {name, label, type, required, min, max, defaultValue} = config.extraField;
        extraFields.innerHTML = `
            <div class="mb-3">
                <label class="form-label">${label}</label>
                <input type="${type}" name="${name}" class="form-control"
                       ${required ? 'required' : ''} 
                       ${min !== undefined ? `min="${min}"` : ''}
                       ${max !== undefined ? `max="${max}"` : ''}
                       value="${defaultValue}">
            </div>
        `;
    } else {
        extraFields.innerHTML = '';
    }

    // Re-attach IP suggestions listener if needed
    if(config.showIpSuggestions) {
        const contentInput = document.getElementById('add_content');
        contentInput.addEventListener('focus', () => showIPs());
        contentInput.addEventListener('input', (e) => filterIPs(e.target.value));
    }
}

function showIPs() {
    const suggestions = document.getElementById('ipSuggestions');
    const type = document.getElementById('add_type').value;
    
    if(type !== 'A') {
        suggestions.classList.add('d-none');
        return;
    }

    suggestions.classList.remove('d-none');
    
    // Group domains by hostnames
    const domainGroups = {};
    serverIPs.forEach(item => {
        const hostname = item.domain.split('.')[0];
        if(!domainGroups[hostname]) {
            domainGroups[hostname] = [];
        }
        domainGroups[hostname].push(item);
    });

    // Generate HTML with grouped suggestions
    let html = '';
    for(const hostname in domainGroups) {
        domainGroups[hostname].forEach(item => {
            html += `
                <div class="p-2 d-flex align-items-center border-bottom select-ip" onclick="selectIP('${item.ip}')">
                    <div class="flex-grow-1">
                        <div style="font-weight: 500;">${item.name}</div>
                        <div class="text-muted small">${item.domain}</div>
                    </div>
                    <div class="ms-2">
                        <code class="text-muted">${item.ip}</code>
                    </div>
                </div>
            `;
        });
    }
    
    suggestions.innerHTML = html;
}

function filterIPs(value) {
    const suggestions = document.getElementById('ipSuggestions');
    if(!value) {
        showIPs();
        return;
    }

    const matchingIPs = serverIPs.filter(item => 
        item.name.toLowerCase().includes(value.toLowerCase()) ||
        item.domain.toLowerCase().includes(value.toLowerCase()) ||
        item.ip.includes(value)
    );

    suggestions.innerHTML = matchingIPs.map(item => `
        <div class="p-2 border-bottom select-ip" onclick="selectIP('${item.ip}')">
            <div class="fw-medium">${item.name}</div>
            <div class="small text-muted">
                ${item.domain}
                <span class="badge bg-light text-dark ms-1">${item.ip}</span>
            </div>
        </div>
    `).join('');
}

function selectIP(ip) {
    document.getElementById('add_content').value = ip;
    document.getElementById('ipSuggestions').classList.add('d-none');
}

// Hide suggestions when clicking outside
document.addEventListener('click', function(e) {
    if(!e.target.closest('#add_content')) {
        document.getElementById('ipSuggestions').classList.add('d-none');
    }
});

// Add styles
const style = document.createElement('style');
style.textContent = `
      .select-ip {
        cursor: pointer;
        transition: background-color 0.15s;
    }
    .select-ip:hover {
        background-color: #f8f9fa;
    }
    #ipSuggestions {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-height: 250px;
        overflow-y: auto;
        z-index: 1060;
    }
    #ipSuggestions code {
        padding: 2px 4px;
        font-size: 13px;
        color: #666;
        background: #f8f9fa;
        border-radius: 3px;
    }
`;
document.head.appendChild(style);

// Edit Record Functions
function editRecord(record) {
    console.log('Editing record:', record);
    
    // Set values
    document.getElementById('edit_record_id').value = record.id;
    document.getElementById('edit_type').value = record.type;
    document.getElementById('edit_type_hidden').value = record.type;
    document.getElementById('edit_name').value = record.name.replace('.' + domain, '');
    document.getElementById('edit_content').value = record.content;
    document.getElementById('edit_ttl').value = record.ttl;
    document.getElementById('edit_proxied').checked = record.proxied;

    // Update content label
    let contentLabel = 'Content';
    switch(record.type) {
        case 'A': contentLabel = 'IPv4 Address'; break;
        case 'AAAA': contentLabel = 'IPv6 Address'; break;
        case 'CNAME': contentLabel = 'Target Domain'; break;
        case 'MX': contentLabel = 'Mail Server'; break;
        case 'TXT': contentLabel = 'TXT Content'; break;
    }
    document.getElementById('edit_content_label').textContent = contentLabel;

    // Show/hide proxy toggle based on record type
    const proxyField = document.getElementById('edit_proxy_field');
    proxyField.style.display = ['A', 'AAAA', 'CNAME'].includes(record.type) ? 'block' : 'none';

    // Show modal
    new bootstrap.Modal(document.getElementById('editRecordModal')).show();
}

// Initialize form when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Set initial record type form
    updateRecordForm(document.getElementById('add_type').value);

    // Initialize tooltips
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => new bootstrap.Tooltip(tooltip));
});
</script>