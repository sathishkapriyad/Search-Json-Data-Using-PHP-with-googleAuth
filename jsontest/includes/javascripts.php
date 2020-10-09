<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script>
    <?php $tab = isset($_GET['tab']) ? $_GET['tab'] : 'organization';?>
    $(document).ready(function() {
       $('#search').on('click', function() {
            if($('#search-text').val().length > 0) {
                $.ajax({url: "functions.php?tab=<?php echo $tab;?>&q=" + $('#search-text').val() + "", success: function(result){
                    $('#filteredList').html(result)
                }});
            }
        });
       $.ajax({url: "functions.php?tab=<?php echo $tab;?>&q=" + $('#search-text').val() + "", success: function(result){
            $('#filteredList').html(result)
        }}) 
    });
</script>