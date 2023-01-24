const toggleIcon = (id1, id2) => {
    document.getElementById(id1).classList.toggle('fa-lock');
    document.getElementById(id1).classList.toggle('fa-lock-open');
    let input = document.getElementById(id2);
    if (input.type == 'password') {
        input.type = 'text';
       // input.placeholder = "f3c1 Password . . . . . .";
    } else if (input.type == 'text') {
        input.type = 'password';
        // input.placeholder = "&#xf023 Password . . . . . .";
    }
};