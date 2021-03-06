<footer class="container-fluid text-center mt-4 pt-4">
    <div class="p-4 pb-0">
        <!-- Section: Social media -->
        <section class="mb-3">
            <!-- Facebook -->
            <a class="btn btn-dark btn-floating m-1" href="#!" role="button"><i class="bi bi-facebook"></i></a>

            <!-- Twitter -->
            <a class="btn btn-dark btn-floating m-1" href="#!" role="button"><i class="bi bi-twitter"></i></a>

            <!-- Google -->
            <a class="btn btn-dark btn-floating m-1" href="#!" role="button"><i class="bi bi-google"></i></a>

            <!-- Instagram -->
            <a class="btn btn-dark btn-floating m-1" href="#!" role="button"><i class="bi bi-instagram"></i></a>

            <!-- Github -->
            <a class="btn btn-dark btn-floating m-1" href="#!" role="button"><i class="bi bi-github"></i></a>
        </section>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3 mb-3">
        <p class="text-light">© 2022 Copyright: <a class="fw-bold text-decoration-none" href="#">Les Lumières</a></p>

    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="JS/function.js" type="module"></script>
<script src="JS/search.js" type="module"></script>
<?php
if (!isConnected($pdo)) {
    echo '<script src="JS/sketch.js"></script>';
}
?>
<script src="JS/darkMode.js" type="module"></script>
<script src="JS/avatar.js"></script>

</body>

</html>