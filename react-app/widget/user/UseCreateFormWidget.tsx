import React from 'react';
import UserAPI from "../../api/UserApi.tsx";

const UserCreateFormWidget: React.FC = () => {

    const handleCreateUser = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            await UserAPI.createUser({login: 'bob2', email: 'test@test.com', plainPassword: 'eeeeeee'})
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <form onSubmit={handleCreateUser}>
            <button type="submit">Save</button>
        </form>
    )
}

export default UserCreateFormWidget;