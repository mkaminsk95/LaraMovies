let messageType = {
    'success': {
        'background': 'bg-green-100',
        'border': 'border-green-400',
        'text': 'text-green-700'
    },
    'error': {
        'background': 'bg-red-100',
        'border': 'border-red-400',
        'text': 'text-red-700'
    },
    'info': {
        'background': 'bg-blue-100',
        'border': 'border-blue-400',
        'text': 'text-blue-700'
    },
    'warning': {
        'background': 'bg-yellow-100',
        'border': 'border-yellow-400',
        'text': 'text-yellow-700'
    }
};

window.messagePanel = {
    messageType: messageType,

    info: function (message, elementClass = 'message') {
        this.display('info', message, elementClass)
    },
    error: function (message, elementClass = 'message') {
        this.display('error', message, elementClass)
    },
    success: function (message, elementClass = 'message') {
        this.display('success', message, elementClass)
    },
    warning: function (message, elementClass = 'message') {
        this.display('warning', message, elementClass)
    },

    hide: function () {
        this.element.classList.remove('block');
        this.element.classList.add('hidden');
    },
    show: function () {
        this.element.classList.remove('hidden');
        this.element.classList.add('block');
    },

    findStylesToDelete: function () {
        return Object.values(this.element.classList).filter(
            function (item) {
                if (item.match(/bg.*-.*|border-.*|text-.*/)) {
                    return item;
                }
            }
        );
    },
    changeStyling: function (type) {
        let stylesToDelete = this.findStylesToDelete();
        stylesToDelete.forEach(item => {
            this.element.classList.remove(item);
        });
        this.element.classList.add(
            messageType[type].background,
            messageType[type].border,
            messageType[type].text
        );
    },

    display: function (type, message, elementClass) {
        if (!this.element) {
            this.element = document.getElementById(elementClass);
        }

        this.show();
        this.changeStyling(type);
        this.element.innerHTML = message;
    }
};
