function createLoading(id){
	if($("#load_" + id).length > 0)
		return;
	$("<div class='spiner-loading' id='load_" + id + "' />").appendTo($("#"+id));
}

function destroyLoading(id){
	$("#load_" + id).remove();
}