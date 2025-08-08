
document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".increment").forEach(function (btn) {
            btn.addEventListener("click", function () {
                  const wrapper = this.closest(".qty-wrapper");
                  const input = wrapper.querySelector(".quantityInput");
                  const productId = wrapper.querySelector(".productId").value;
                  let qty = parseInt(input.value);

                  if (qty < 99) {
                        qty++;
                        input.value = qty;
                        updateQuantityData(productId, qty, '?page=order&action=add');
                  }
            });
      });

      document.querySelectorAll(".decrement").forEach(function (btn) {
            btn.addEventListener("click", function () {
                  const wrapper = this.closest(".qty-wrapper");
                  const input = wrapper.querySelector(".quantityInput");
                  const productId = wrapper.querySelector(".productId").value;
                  let qty = parseInt(input.value);

                  if (qty > 1) {
                        qty--;
                        input.value = qty;
                        updateQuantityData(productId, qty, '?page=order&action=add');
                  }
            });
      });

      async function updateQuantityData(productId, qty, url) {
            error = false;
            try {
                  const response = await fetch(url, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
                        body: new URLSearchParams({
                              'productIncDec': true,
                              'product_id': productId,
                              'quantity': qty
                        })
                  })

                  const data = await response.json();

                  if(data.status === 200) {
                        const itemTotalElement = document.querySelector(
                              `.itemTotal[data-product-id="${data.data.product_id}"]`
                        );
                        if (itemTotalElement) {
                              itemTotalElement.textContent = data.data.item_total;
                        }
                  } else {
                        error = true;
                        if(error) {
                              const span = document.createElement('span');
                              span.textCntent = data.message;
                              const errorDiv = document.querySelector('.errorMessage');
                              errorDiv.setAttribute('hidden', false);
                              errorDiv.append(span);
                        }
                        document.querySelector('.errorMessage').append();
                        console.error(data.message);
                  }

            } catch($err) {
                  console.error('AJAX error:', error);
            }
      }

      // Proceed to payment

      const placeOrderButton = document.getElementById('placeOrderBtn');

      placeOrderButton?.addEventListener('click', handleProcessToPayment);

      async function handleProcessToPayment() {
            const customerPhone = document.getElementById('customer_phone');
            const paymentMode = document.getElementById('payment_mode');
            let errors = []; // use `let` so you can reassign it later

            // Validation
            if (!customerPhone.value && !paymentMode.value) {
                  errors.push('Payment Method is Required', 'Customer Phone is Required');
                  Swal.fire({
                        title: "Warning!",
                        text: "Select Payment Method, Customer Phone is missing.",
                        icon: "warning"
                  });
                  return;
            } else {
                  if (!customerPhone.value) {
                        errors.push('Customer Phone is Required');
                        Swal.fire({
                              title: "Warning!",
                              text: "Customer Phone is requred",
                              icon: "warning"
                        });
                        return;
                  }
                  if (!paymentMode.value) {
                        errors.push('Payment Method is Required');
                        Swal.fire({
                              title: "Warning!",
                              text: "Payment Method is Requiredo.",
                              icon: "warning"
                        });
                        return;
                  }
            }

            // Displaying Errors to the UI Frontend
            // if (errors.length > 0) {
            //       const errorMessage = document.querySelector('.errors');
            //       errorMessage.removeAttribute('hidden');
            //       errorMessage.innerHTML = ''; 

            //       errors.forEach((err) => {
            //             errorMessage.innerHTML += err + "<br/>";
            //       });
            //       return;
            // }

            const res = await fetch('?page=order&action=payment', {
                  method: 'POST',
                  headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                  },
                  body: new URLSearchParams({
                        payment_mode: paymentMode.value,
                        customer_phone: customerPhone.value,
                        submit: 'true'
                  })
            });
            const data = await res.json();
            if (data.status === 200) {
                  // console.log('✅ Success:', data);
                  Swal.fire({
                        title: "Payment Successful",
                        text: "The payment has been processed successfully.",
                        icon: "success",
                        confirmButtonText: "OK"
                  });
            } else if(data.status === 404) {
                  Swal.fire({
                        title: "Customer Not Found",
                        text: "Would you like to add a new customer?",
                        icon: "error",
                        showCancelButton: true,
                        confirmButtonText: "Add Customer",
                        cancelButtonText: "Cancel"
                  }).then((result) => {
                        if (result.isConfirmed) {
                              // Open the modal (you must have this modal defined in your HTML)
                              // const customerModal = document.getElementById('addCustomerModal');
                              // if (customerModal) {
                              //       customerModal.removeAttribute('hidden'); // or use Bootstrap's modal trigger
                              // // If you're using Bootstrap modal:
                              // // new bootstrap.Modal(customerModal).show();
                              // }
                              const customerModal = new bootstrap.Modal(document.getElementById('addCustomerModal'));
                              customerModal.show();
                        }
                  });
            } else {
                  Swal.fire({
                        title: "Server Error",
                        text: "contact IT Department",
                        icon: "error",
                        showCancelButton: true,
                        confirmButtonText: "Close",
                  })
            }
      }
})
