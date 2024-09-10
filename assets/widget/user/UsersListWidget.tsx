import React from 'react';
import {useSearchParams} from "react-router-dom";
import {Button} from "@mui/material";
import useGetManyUsersByParams from "../../hooks/user/useGetManyUserByParams.tsx";
import UserCardWidget from "./UserCardWidget.tsx";
import UsersTableWidget from "./UsersTableWidget.tsx";

const UsersListWidget: React.FC = () => {
    const [searchParams] = useSearchParams();
    const users = useGetManyUsersByParams();

    if (!users) {
        return <p>No Users found.</p>
    }

    const display = searchParams.get('display') || 'table';

    console.log(display);

    return (
        <div>
            <h1>Liste des utilisateurs</h1>

            { display == 'card' && (
                users.map((user) => (
                    <div key={'user_'+user.id}>
                        <UserCardWidget user={user} />
                    </div>
                )))
            }

            { display == 'table' && (
                <UsersTableWidget users={users} />
            )}

            <Button>Test</Button>
        </div>
    );
}

export default UsersListWidget;