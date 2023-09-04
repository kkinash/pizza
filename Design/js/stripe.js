const stripe = Stripe("pk_test_51NadZMJvPw1XfvmckNOCErUC5wOriJ2kyawSvMez3vOWRcUCU5xx1ydO5bhDSuK26PAcLvCiEbnxdypFVtUeCTMb008wf82b7x")
const btn = document.getElementById('btn-stripe');
console.log(btn);
btn.addEventListener('click', () => {
    fetch('./payment.php', {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({})
    }).then(res => res.json())
        .then(payload => {
            stripe.redirectToCheckout({ sessionId: payload.id })
        })
})