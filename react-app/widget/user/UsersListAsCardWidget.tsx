import React from 'react';
import useGetManyUsersByParams from "../../hooks/user/useGetManyUserByParams.tsx";
import UserCardWidget from "./UserCardWidget.tsx";
import UsersListFilters from "../../filters/UsersListFilters.tsx";

type UsersListAsCardWidgetProps = {
    filters: UsersListFilters;
}

const UsersListAsCardWidget: React.FC<UsersListAsCardWidgetProps> = ({ filters }) => {
    const users = useGetManyUsersByParams(filters);

    if (!users) {
        return <p>No Users found.</p>
    }


    return (
        <div>
            <h1>{users.length} Utilisateurs</h1>

            { users.map((user) => (
                <div key={'user_'+user.id}>
                    <UserCardWidget user={user} linkToDetails={true} />
                </div>
            ))}
        </div>
    );
}

export default UsersListAsCardWidget;