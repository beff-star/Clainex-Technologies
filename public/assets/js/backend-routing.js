document.querySelectorAll('[data-backend-path]').forEach((element) => {
    const destination = new URL(
        element.getAttribute('data-backend-path'),
        `${window.CLAINEX_BACKEND_URL.replace(/\/+$/, '')}/`
    );

    if (element.tagName === 'FORM') {
        element.action = destination.href;
    } else {
        element.href = destination.href;
    }
});
