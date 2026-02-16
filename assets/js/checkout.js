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

function toggle_address() {
  const address = document.querySelector('.delivery_address_off');
  const collect = document.querySelector('.delivery_collect_off');
  // Se Address estiver fechado e remove delivery_collect
  if (!address.classList.contains('delivery_address_on')) {
    address.classList.add('delivery_address_on');
    collect.classList.remove('delivery_collect_on');
  } else {
    // Se Address estiver aberto e remove delivery_address
    address.classList.remove('delivery_address_on');
  }
}

function toggle_collect() {
  const collect = document.querySelector('.delivery_collect_off');
  const address = document.querySelector('.delivery_address_off');

  // Se Collect estiver fechado, abre
  if (!collect.classList.contains('delivery_collect_on')) {
    collect.classList.add('delivery_collect_on');
    address.classList.remove('delivery_address_on');
  } else {
    // Se Collect estiver aberto
    collect.classList.remove('delivery_collect_on');
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