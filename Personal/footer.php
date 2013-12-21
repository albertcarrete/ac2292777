<!-- <div class="footer">
	<div class="row">
		<div class="grid_12">
			<ul>
				<li>hello</li>
				<li>hello</li>
			</ul>
		</div>
	</div>
</div>	 -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">

			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-5').removeClass('active');
				});

			});

		</script>

  <script src="./js/masonry.pkgd.min.js"></script>
  <script>
var container = document.querySelector('#container');
var msnry = new Masonry( container, {
  // options
  columnWidth: 290,
  itemSelector: '.element'
});
  </script>

</body>
</html>