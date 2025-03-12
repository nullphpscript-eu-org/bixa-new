<!-- Main Content -->
<div class="main-content">
   <div class="page-content">
       <div class="container-fluid">

           <!-- Page Title -->
           <div class="row">
               <div class="col-12">
                   <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                       <h4 class="mb-sm-0 font-size-18">Edit Email Template</h4>
                       
                       <!-- Back Button -->
                       <a href="<?= base_url('email/templates?type='.$active) ?>" class="btn btn-secondary waves-effect waves-light">
                           <i data-feather="arrow-left" class="me-1"></i>
                           Back to Templates
                       </a>
                   </div>
               </div>
           </div>

           <!-- Email Edit Form -->  
           <div class="row">
               <div class="col-12">
                   <div class="card">
                       <div class="card-body">
                           <?= form_open('email/edit/'.$email['email_id'].'?type='.$active) ?>
						       <input type="hidden" name="type" value="<?= $active ?>">
                               <!-- Subject Field -->
                               <div class="mb-3">
                                   <div class="d-flex align-items-center mb-2">
                                       <i data-feather="mail" class="font-size-20 text-primary me-2"></i>
                                       <label for="subject" class="form-label mb-0">Subject</label>
                                   </div>
                                   <input type="text" class="form-control" id="subject" name="subject" value="<?= $email['email_subject'] ?>">
                               </div>

                               <!-- Content Field with TinyMCE -->
                               <div class="mb-3">
                                   <div class="d-flex align-items-center mb-2">
                                       <i data-feather="file-text" class="font-size-20 text-primary me-2"></i>
                                       <label for="content" class="form-label mb-0">Content</label>
                                   </div>
                                   <textarea id="content" name="content"><?= $email['email_content'] ?></textarea>
                               </div>

                               <!-- Custom Variables Field -->
                               <div class="mb-3">
                                   <div class="d-flex align-items-center mb-2">
                                       <i data-feather="code" class="font-size-20 text-primary me-2"></i>
                                       <label for="variables" class="form-label mb-0">Custom Variables</label>
                                   </div>
                                   <textarea class="form-control" id="variables" rows="4" readonly><?= $email['email_doc'] ?></textarea>
                               </div>

                               <!-- Submit Button -->
                               <div class="mt-4">
                                   <button type="submit" name="update" value="Update" class="btn btn-primary waves-effect waves-light d-inline-flex align-items-center">
                                       <i data-feather="save" class="me-1"></i>
                                       <span>Save Changes</span>
                                   </button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/tinymce/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
   // Initialize Feather Icons
   feather.replace();

   // Initialize TinyMCE
   tinymce.init({
       selector: '#content',
       branding: false,
       promotion: false,
       height: 500,
       plugins: [
           'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
           'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
           'insertdatetime', 'media', 'table', 'help', 'wordcount', 'codesample'
       ],
       toolbar: 'undo redo | formatselect | ' +
           'bold italic backcolor | alignleft aligncenter ' +
           'alignright alignjustify | bullist numlist outdent indent | ' +
           'removeformat | code | help',
       content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
       codesample_languages: [
           {text: 'HTML/XML', value: 'markup'},
           {text: 'JavaScript', value: 'javascript'},
           {text: 'CSS', value: 'css'},
           {text: 'PHP', value: 'php'},
           {text: 'SQL', value: 'sql'}
       ],
       setup: function(editor) {
           editor.on('change', function() {
               editor.save();
           });
       }
   });
});
</script>