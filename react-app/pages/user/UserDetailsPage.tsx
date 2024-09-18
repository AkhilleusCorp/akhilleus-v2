import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UserDetailsCard from "../../widget/user/UserDetailsCard.tsx";
import {useParams} from "react-router-dom";
import ErrorPage from "../ErrorPage.tsx";
import useGetOneUseById from "../../hooks/user/useGetOneUserById.tsx";

const UserDetailsPage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();

    const user = useGetOneUseById(userId);
    if (!user) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <h1>User Page</h1>
            <UserDetailsCard user={user} linkToDetails={false}/>
        </AdminLayout>
    );
}

export default UserDetailsPage;