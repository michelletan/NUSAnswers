<script src="../js/jquery-1.12.2.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript">
$.ajax({
  url: "/json/something"
}).success(function(data) {
  alert(data);
  console.log(data);
});
</script>
</html>
