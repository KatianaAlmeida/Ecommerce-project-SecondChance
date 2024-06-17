function insert_form(){
  const insert_address = document.querySelector('.insert_address_off'); 
  const new_address = document.querySelector('.new_address'); 
  if(!insert_address.classList.contains('insert_address_on')){
    insert_address.classList.add('insert_address_on');
    new_address.innerHTML = 'Hide';

  } else{
    insert_address.classList.remove('insert_address_on');
    new_address.innerHTML = 'New Address';
  }
}

function insert_form1(){
  const insert_address = document.querySelector('.insert_address1_off'); 
  const new_address = document.querySelector('.new_address1'); 
  if(!insert_address.classList.contains('insert_address1_on')){
    insert_address.classList.add('insert_address1_on');
    new_address.innerHTML = 'Hide';

  } else{
    insert_address.classList.remove('insert_address1_on');
    new_address.innerHTML = 'New Address';
  }
}

function open_address(){
  const delivery_address_off = document.querySelector('.delivery_address_off'); 
  if(!delivery_address_off.classList.contains('delivery_address_on')){
    delivery_address_off.classList.add('delivery_address_on');
  } 
}
function close_address(){
  const delivery_address_off = document.querySelector('.delivery_address_off'); 
  if(delivery_address_off.classList.contains('delivery_address_on')){
    delivery_address_off.classList.remove('delivery_address_on');
  } 
}


const delivery_type = document.getElementsByName('delivery_type');
// Loop through each radio button to attach the event listener
delivery_type.forEach(button => {
  button.addEventListener('click', function() {
    let selectedValue = '';

    for (let i = 0; i < delivery_type.length; i++) {
      if (delivery_type[i].checked) {
        selectedValue = delivery_type[i].value;
        break;
      }
    }
    console.log(selectedValue);
    const deliveryTypeHidden = document.getElementById('delivery_type_hidden');
    deliveryTypeHidden.value = selectedValue;
  });
});

const choosen_address = document.getElementsByName('choosen_address');
// Loop through each radio button to attach the event listener
choosen_address.forEach(button => {
  button.addEventListener('click', function() {
    let selectedValue = '';

    for (let i = 0; i < choosen_address.length; i++) {
      if (choosen_address[i].checked) {
        selectedValue = choosen_address[i].value;
        break;
      }
    }
    console.log(selectedValue);
    const deliveryTypeHidden = document.getElementById('choosen_address_hidden');
    deliveryTypeHidden.value = selectedValue;
  });
});

const choosen_card = document.getElementsByName('choosen_card');
// Loop through each radio button to attach the event listener
choosen_card.forEach(button => {
  button.addEventListener('click', function() {
    let selectedValue = '';

    for (let i = 0; i < choosen_card.length; i++) {
      if (choosen_card[i].checked) {
        selectedValue = choosen_card[i].value;
        break;
      }
    }
    console.log(selectedValue);
    const deliveryTypeHidden = document.getElementById('choosen_card_hidden');
    deliveryTypeHidden.value = selectedValue;
  });
});

const choosen_payment = document.getElementsByName('choosen_payment');
// Loop through each radio button to attach the event listener
choosen_payment.forEach(button => {
  button.addEventListener('click', function() {
    let selectedValue = '';

    for (let i = 0; i < choosen_payment.length; i++) {
      if (choosen_payment[i].checked) {
        selectedValue = choosen_payment[i].value;
        break;
      }
    }
    console.log(selectedValue);
    const deliveryTypeHidden = document.getElementById('choosen_payment_hidden');
    deliveryTypeHidden.value = selectedValue;
  });
});

function toggleMessage() {
  const showRadio = document.querySelector('input[name="choosen_payment"][value="Credit and Debit Card"]');
  const messageDiv = document.getElementById('display_card_info');
  
  if (showRadio.checked) {
      messageDiv.style.display = 'block';
  } else {
      messageDiv.style.display = 'none';
  }
}