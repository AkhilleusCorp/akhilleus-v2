import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import UserUpdateForm from "../../widget/user/UserUpdateForm.tsx";
import useGetOneUserById from "../../hooks/user/useGetOneUserById.tsx";
import ErrorPage from "../ErrorPage.tsx";

const UserUpdatePage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    const user = useGetOneUserById(userId);
    if (!user) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <UserUpdateForm user={user} />
        </AdminLayout>
    );
}

export default UserUpdatePage;