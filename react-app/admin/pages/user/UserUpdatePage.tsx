import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import UserUpdateForm from "app/admin/features/user/UserUpdateForm.tsx";
import useGetOneUserById from "app/admin/hooks/user/useGetOneUserById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";

const UserUpdatePage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    const user = useGetOneUserById(userId);
    if (!user) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <h3>
                {user.username} #{user.id}
            </h3>
            <UserUpdateForm user={user} />
        </AdminLayout>
    );
}

export default UserUpdatePage;