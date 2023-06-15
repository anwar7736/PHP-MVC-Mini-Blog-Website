


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    $(function(){
      $(document).on('click', '.delete-btn', function(e){
            e.preventDefault();
            if(confirm('Are you sure?'))
            {
              $(this).closest('form#delete-form').submit();
            }
        });        
        
        $(document).on('change', '#image', function(e){
            let file = e.target.files[0];
            let tempURL = URL.createObjectURL(file);
            $(document).find('div.preview-img').remove();
            $(this).after(`<div class="preview-img mt-2">
              <img src="${tempURL}" class="h-50 w-50"/>
            </div>`);
        });

        $('.summernote').summernote({
          height: 200,
        });

        setTimeout(() => {
           remove_alert();
        }, 5000);

        $(document).on('click', 'button.btn-close', function(e){
            remove_alert();
        });

        function remove_alert()
        {
            <?php destroy('message'); ?>
            $(document).find('div.alert').remove();
        }
        
    });
</script>
</body>
</html>
