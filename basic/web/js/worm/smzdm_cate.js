var all = $('#cateBusi').find('dl');
var ar = new Array();
$.each(all,function(i)
{
	var subTitle = new Array();
	var titles = $(all[i]).find('a');
	$.each(titles,function(i){subTitle.push($(titles[i]).text())});
	var single = {
		'title' : $(all[i]).find('h3').text(),
		'subTitle' : subTitle
	};
	ar.push(single);
})
