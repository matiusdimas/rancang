<?php  
if(isset($_SESSION['username'])){?>
    <script>
            const userBtn = document.querySelector('#user-btn');
            const userDrop = document.querySelector('#user-list');
    
    
            userBtn.addEventListener('click', function() {
                userDrop.classList.toggle('hidden')
            })
    </script>
<?php } ?>