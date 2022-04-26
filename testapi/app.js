function putTodo(todo) {
    let options = {
        method : 'PUT',
            headers : {
                "Content-type": "application/json"
            },
             body : JSON.stringify(todo)
    };
    console.log(todo);
    fetch(window.location.href + 'api/todo',options)
        .then(response => response.json())  // convert to json
        .then(json => console.log(json))    //print data to console
        .catch(err => console.log('Request Failed', err)); // Catch errors
    console.log("calling putTodo");
    console.log(todo);
}

function postTodo(todo) {
    let options = {
        method : 'POST',
            headers : {
                "Content-type": "application/json"
            },
             body : JSON.stringify(todo)
    };
    fetch(window.location.href + 'api/todo',options)
        .then(response => response.json())  // convert to json
        .then(json => console.log(json))    //print data to console
        .catch(err => console.log('Request Failed', err)); // Catch errors
    console.log(todo);
}

function deleteTodo(todo) {
    let options = {
        method : 'DELETE',
            headers : {
                "Content-type": "application/json"
            },
             body : JSON.stringify(todo)
    };
    fetch(window.location.href + 'api/todo',options)
        .then(response => response.json())  // convert to json
        .then(json => console.log(json))    //print data to console
        .catch(err => console.log('Request Failed', err)); // Catch errors
    console.log("calling deleteTodo");
    console.log(todo);
}

// example using the FETCH API to do a GET request
function getTodos() {
    fetch(window.location.href + 'api/todo')
        .then(response => response.json())
        .then(json => drawTodos(json))
        .then(json => console.log(json))
        .catch(error => showToastMessage('Failed to retrieve todos...'));
}

getTodos();