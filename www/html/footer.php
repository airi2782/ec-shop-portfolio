<script src="jquery.min.js"></script>
  <script>
    $('.menu dd').hide();
    $('.menu dt').on('click',function(){
      $(this).next().slideToggle();
    })
  </script>

</body>
</html>