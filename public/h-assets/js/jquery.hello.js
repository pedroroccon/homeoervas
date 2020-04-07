$(function()
{
	console.log('Hello from Hive!');

	/**
	 * Memoriza o estado dos menus da navegação
	 */

	var panels = localStorage.panels === undefined ? new Array() : JSON.parse(localStorage.panels);
	for (var i in panels) {
        if ($(panels[i]).hasClass('collapse')) {
            $(panels[i]).collapse("show");
        }
    }
	$('#hello-nav-accordion .item').on('shown.bs.collapse', function ()
	{
		var active = $(this).find('.hello-nav-menu-item').attr('href');
		var panels = localStorage.panels === undefined ? new Array() : JSON.parse(localStorage.panels);
		
		if($.inArray(active,panels) == -1) {
			panels.push(active);
		}
		localStorage.panels = JSON.stringify(panels);
	});
	$('#hello-nav-accordion .item').on('hidden.bs.collapse', function () {
		var active = $(this).find('.hello-nav-menu-item').attr('href');
		var panels = localStorage.panels === undefined ? new Array() : JSON.parse(localStorage.panels);
		var index = $.inArray(active,panels);

		if (index !== -1) {        
			panels.splice(index, 1);
		}
		localStorage.panels = JSON.stringify(panels);
	});

	$('.form-pagination-page').change(function() {
		$(this).parents('form').submit();
	});

	/**
	 * Sends a confirmation message for the user
	 * before he delete the register.
	 */
	$('.btn-confirm-delete').click(function(event)
	{
		event.preventDefault();

		var form = $(this).parents('form');
		var confirmation = confirm('Tem certeza que deseja remover este item? Este procedimento é irreversível.');

		if(confirmation) {
			form.submit();
		}
	});

	// Tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Tabelas com scroll
	var mx = 0;

	$('.table-responsive').on({
	  mousemove: function(e) {
		var mx2 = e.pageX - this.offsetLeft;
		if(mx) this.scrollLeft = this.sx + mx - mx2;
	  },
	  mousedown: function(e) {
		this.sx = this.scrollLeft;
		mx = e.pageX - this.offsetLeft;
	  }
	});
	
	$(document).on('mouseup', function(){
		mx = 0;
	});


}, (jQuery));
