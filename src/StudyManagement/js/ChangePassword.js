$(document).ready(function()
{
    $('.pass_show').append('<span class="ptxt">Hiện</span>');  
});
$(document).on('click','.pass_show .ptxt', function()
{
    $(this).text($(this).text() == "Hiện" ? "Ẩn" : "Hiện");
    $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });
});