<?php if(isset($_SESSION['message'])) : ?>
<div id="alertMessage" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Data Saved Successfully!</strong> <?php echo $_SESSION['message']; ?>
</div>
<?php unset($_SESSION['message']); ?>
<script>
    // Auto-hide the alert after 5 seconds
    setTimeout(function() {
        document.getElementById('alertMessage').style.display = 'none';
    }, 1000);
</script>
<?php endif; ?>