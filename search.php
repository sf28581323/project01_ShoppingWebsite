<div class="sidebar mb-3">
    <form name="search" id="search" action="./drugstore.php" method="get">
        <div class="input-group">
            <input type="text" name="search_name" id="search_name" class="form-control" placeholder="Search..." value="<?php echo (isset($_GET['search_name'])) ? $_GET['search_name'] : ''; ?>" required>
            <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fas fa-search fa-lg"></i></button></span>
        </div>
    </form>
</div>