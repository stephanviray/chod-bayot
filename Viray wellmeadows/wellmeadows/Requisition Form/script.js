function calcTotal(){
    		document.requisitionForm.Total.value=parseInt(document.requisitionForm.Quantity.value)* parseInt(document.requisitionForm.Cost.value);
     	}
        const scriptURL = 'https://script.google.com/macros/s/AKfycby8LwCmLsvIg-bA1457wkrTeBziQfEFW6fGoPfm9jxbB03ZEC0/exec'
        const form = document.forms['requisitionForm'];
          
        form.addEventListener('submit', e => {
        	e.preventDefault()
            fetch(scriptURL, { method: 'POST', body: new FormData(form)})
            .then(response => alert("Your requisition has been received"))
            .catch(error => console.error('Error!', error.message));
        });
