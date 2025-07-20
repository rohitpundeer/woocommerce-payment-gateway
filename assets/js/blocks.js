const { registerPaymentMethod } = window.wc.wcBlocksRegistry;
registerPaymentMethod({
    name: 'my_custom_gateway',
    label: 'My Custom Gateway',
    ariaLabel: 'custom',
    content: <p>Pay securely using My Custom Gateway.</p>,
    edit: <p>My Custom Gateway – edit view</p>,
    canMakePayment: () => true,
    supports: {
        showSavedCards: false,
        showSaveOption: false,
    },
});

