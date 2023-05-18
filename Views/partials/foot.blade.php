


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $(function(){
        $(document).on('click', '.delete-btn', function(e){
            e.preventDefault();
            if(confirm('Are you sure?'))
            {
              $(this).closest('form#delete-form').submit();
            }
        });
    });
</script>
</body>
</html>
