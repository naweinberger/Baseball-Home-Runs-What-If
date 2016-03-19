// nav bar js
$('#toggle').click(function() {
	//give the thing last clicked have class 'active'
	//if it is inactive
	$(this).toggleClass('active');

	//open or close the things with overlay as id
	$('#overlay').toggleClass('open');
});

// slider js
// Instantiate a slider
// Without JQuery
// var slider = new Slider('#ex1', {
// 	formatter: function(value) {
// 		return 'Current value: ' + value;
// 	}
// });

// var RGBChange = function() {
// 	$('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
// };

// var r = $('#R').slider()
// 		.on('slide', RGBChange)
// 		.data('slider');
// var g = $('#G').slider()
// 		.on('slide', RGBChange)
// 		.data('slider');
// var b = $('#B').slider()
// 		.on('slide', RGBChange)
// 		.data('slider');

$(function() {
	$( "#slider-1" ).slider();
});