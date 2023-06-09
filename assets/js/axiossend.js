$(document).ready(()=>{

  $('form').submit(async (event)=>{
    event.preventDefault();
    var route=$("form").attr("action");
    var data=$('form').serializeArray();
    await axios.post(route,data)
    .then((response)=>{
      if(response.data.error){
        console.log("error")
        $('.sent-message').html(`<span class="text-danger">
        Sorry, message not sent due to server error</span>`)
      }
      if(response.data.success){
        $('.sent-message').html(`<span class="text-success">
          Message sent</span>`)
      }

    })
    .catch((err)=>console.log(err));
    setTimeout(()=>{
     $('.sent-message').hide();
    },8000)
  })
    
});



