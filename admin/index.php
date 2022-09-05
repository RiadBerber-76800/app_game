<!-- header -->

<?php 
$title= "Admin dashboard";
include("partials/_header.php") 
?>

<!-- content -->
<div class="parent flex">
    <?php include("partials/_left-navigation.php") ?>
    <div class="content-right p-8">
        <?php include("partials/_table.php") ?>
    </div>
    


</div>

<!-- footer -->
<?php include("partials/_footer.php") ?>