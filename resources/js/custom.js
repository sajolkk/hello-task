
//--- make column editable > start
// $(document).on('click', '.row_data',function(event){
//     if($(this).attr('edit_type') == 'button' && $(this).attr('type') != 'file')
// 	{
// 		return false; 
// 	}
//     //make input editable    
//     if($(this).attr('input_type') == 'file'){
//         $(this).children('input').removeClass('d-none').addClass('bg-warning');
//         $(this).children('img').addClass('d-none');
//     }else{
//         $(this).closest('input').removeAttr('readonly').removeClass('bg-transparent').addClass('bg-warning');
//     }
// })
//--- make column editable > end

// whole row editable by button click start
//--- button > edit > start	
$(document).on('click', '.btn_edit', function(event) 
{
	// event.preventDefault();
	var tbl_row = $(this).closest('tr');

    // show update and cancel button
	tbl_row.find('.btn_update').removeClass('d-none');
	tbl_row.find('.btn_cancel').removeClass('d-none');

	//hide edit button
	tbl_row.find('.btn_edit').addClass('d-none'); 
    // image hide if it is exit
    tbl_row.find('.img_row').children('img').addClass('d-none');

	//make the whole row input editable
	tbl_row.find('input')
	.removeAttr('readonly').removeClass('bg-transparent d-none').addClass('bg-warning')
	.attr('edit_type', 'button');

	// company selection editable
	tbl_row.find('.company')
	.removeAttr('disabled').removeClass('bg-transparent border-0').addClass('bg-warning')
	.attr('edit_type', 'button');

	//--- add the original entry > start
	tbl_row.find('.row_data').each(function(index, val) 
	{  
		//this will help in case user decided to click on cancel button
		$(this).attr('original_entry', $(this).val());
	});


    // form company image 
    tbl_row.find('.img_row').each(function(index, val) 
	{  		
        //this will help in case user decided to click on cancel button
		$(this).attr('original_entry', $(this).html());
	}); 		
	//--- add the original entry > end

	// add the company orginal data
	tbl_row.find('.company').each(function(index, val) 
	{  		
        //this will help in case user decided to click on cancel button
		$(this).attr('original_entry', $(this).html());
	}); 

});
// whole row editable by button click start


// Cancel User Table Data Entry function start
$(document).on('click', '.btn_cancel', function(event) 
{
	event.preventDefault();
	var tbl_row = $(this).closest('tr');
	var row_id = tbl_row.attr('row_id');

	//hide update and cacel buttons
	tbl_row.find('.btn_update').addClass('d-none');
	tbl_row.find('.btn_cancel').addClass('d-none');

	//show edit button
	tbl_row.find('.btn_edit').removeClass('d-none');

	//make the whole row non editable
	tbl_row.find('input[type="text"]')
	.attr('readonly',true).addClass('bg-transparent').removeClass('bg-warning')
	.attr('edit_type', 'click');   

    // set previous data
	tbl_row.find('.row_data').each(function(index, val) 
	{   
		$(this).val( $(this).attr('original_entry')); 
	});  

	// company previous image set and convert to non editable
    tbl_row.find('.img_row').each(function(index, val) 
	{   //set previous data
		$(this).html( $(this).attr('original_entry') ); 
		//non editable
        tbl_row.find('.img_row').children('input[type="file"]').addClass('d-none').val("");
        tbl_row.find('.img_row').children('img').removeClass('d-none');
	});

	// company previous data set and convert to non editable 
	tbl_row.find('.company').each(function(index, val) 
	{  		
		//set previous data and non editable
		$(this).html( $(this).attr('original_entry'))
		.attr('disabled',true).addClass('bg-transparent border-0').removeClass('bg-warning')
		.attr('edit_type', 'button');
	});

});
// Cancel User Table Data Entry function end

