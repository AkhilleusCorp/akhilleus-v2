import React from 'react';
import {useSearchParams} from "react-router-dom";
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

    return (
        <div>
            <h1>{users.length} Utilisateurs</h1>

            { display == 'card' && (
                users.map((user) => (
                    <div key={'user_'+user.id}>
                        <UserCardWidget user={user} linkToDetails={true} />
                    </div>
                )))
            }

            { display == 'table' && (
                <UsersTableWidget users={users} />
            )}
        </div>
    );
}

export default UsersListWidget;