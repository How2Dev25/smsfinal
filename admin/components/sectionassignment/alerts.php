<?php if (isset($_GET['status'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($_GET['status'] == 'success'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Section added successfully!',
                    showConfirmButton: false,
                    timer: 2000
                });
            <?php else: ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error adding section!',
                    showConfirmButton: false,
                    timer: 2000
                });
            <?php endif; ?>
        });
    </script>
<?php endif; ?>