import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import UserUpdateForm from "../../widget/user/UserUpdateForm.tsx";
import useGetOneUseById from "../../hooks/user/useGetOneUserById.tsx";
import ErrorPage from "../ErrorPage.tsx";

const UserUpdatePage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    const user = useGetOneUseById(userId);
    if (!user) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <h1>Edit User #{userId}</h1>
            <div>
                <UserUpdateForm user={user} />
            </div>
        </AdminLayout>
    );
}

export default UserUpdatePage;