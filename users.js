let users = [];

// Default demo user
const defaultUser = {
    name: "Demo User",
    username: "demo@traveltales.com",
    password: "demo123"
};

function addUser(name, username, password) {
    const existingUser = users.find(user => user.username === username);
    if (existingUser) {
        return false; 
    }
    users.push({
        name: name,
        username: username,
        password: password
    });
    localStorage.setItem('traveltales_users', JSON.stringify(users));
    return true;
}

function validateLogin(username, password) {
    const user = users.find(user => user.username === username && user.password === password);
    return user || null;
}

function checkUserExists(username) {
    return users.find(user => user.username === username) ? true : false;
}

function loadUsers() {
    const storedUsers = localStorage.getItem('traveltales_users');
    if (storedUsers) {
        users = JSON.parse(storedUsers);
    } else {
        //agar koi user naa ho to default user use karo
        users = [defaultUser];
        localStorage.setItem('traveltales_users', JSON.stringify(users));
    }
}

//init all users jab page load ho
document.addEventListener('DOMContentLoaded', () => {
    loadUsers();
});