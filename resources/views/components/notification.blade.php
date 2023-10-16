<div>
    <div
        x-data="{ open: false}"
        x-show="open"
        @notify.window="
    Toastify({
        text: $event.detail.message,
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: 'top', // `top` or `bottom`
        position: 'right', // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
        background: ($event.detail.title === 'success')
              ? 'linear-gradient(to right, #00b09b, #96c93d)'
              : 'linear-gradient(to right, #CE3A2E, #DE7B73)',
        },

        }).showToast();"
    >
    </div>
</div>
