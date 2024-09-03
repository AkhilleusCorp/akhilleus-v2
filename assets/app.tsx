import './styles/app.css';

enum PersonType {
    ADMIN = 'admin',
    USER = 'user'
}

type Person = {
    name: string;
    age: number;
    role: PersonType
}

const bob: Person = {
    name: 'bob',
    age: 30,
    role: PersonType.USER
};

console.log(bob);