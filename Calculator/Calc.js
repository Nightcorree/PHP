const addToDisplay = value => {
    if (/[\d()+\-*/.]/.test(value)) {
        display.value += value;
    } else {
        alert("Введен недопустимый символ");
    }
};

const handleKeyPress = event => {
    const keyPressed = event.key;
    const validCharacters = /[\d()+\-*/.]/;
    if (validCharacters.test(keyPressed)) {
        addToDisplay(keyPressed);
    }
};


const clearDisplay = () => display.value = '';

const removeLast = () => {
    const currentValue = display.value;
    display.value = currentValue.slice(0, -1);
};



const calculate = () => {
    const expression = display.value;
    if (expression.includes("/0")) {
        alert("Ошибка: деление на ноль");
        return;
    }
    fetch('calc.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `expression=${encodeURIComponent(expression)}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Ошибка сети');
        }
        return response.text();
    })
    .then(result => display.value = result)
    .catch(error => console.error('Ошибка:', error));
};
