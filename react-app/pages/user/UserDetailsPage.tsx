import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UserDetailsCard from "../../widget/user/UserDetailsCard.tsx";
import {useParams, useNavigate} from "react-router-dom";
import ErrorPage from "../ErrorPage.tsx";
import useGetOneUseById from "../../hooks/user/useGetOneUserById.tsx";
import UserEditButton from "../../widget/user/UserEditButton.tsx";
import UserDeleteButton from "../../widget/user/UserDeleteButton.tsx";

const UserDetailsPage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    const navigate = useNavigate();

    const user = useGetOneUseById(userId);
    if (!user) {
        return <ErrorPage />
    }

    const onConfirmDelete = (userId: number) => {
        console.log(userId);
        navigate('/users');
    }

    return (
        <AdminLayout>
            <UserDetailsCard user={user}/>
            <UserEditButton userId={user.id} />
            <UserDeleteButton userId={user.id} callbackFunction={onConfirmDelete} />
        </AdminLayout>
    );
}

export default UserDetailsPage;