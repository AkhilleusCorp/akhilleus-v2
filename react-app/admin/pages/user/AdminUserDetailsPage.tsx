import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import AdminUserPreviewCard from "app/admin/features/user/AdminUserPreviewCard.tsx";
import {useNavigate, useParams} from "react-router-dom";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import useGetOneUserById from "app/common/hooks/user/useGetOneUserById.tsx";
import AdminUserLifecycleCard from "app/admin/features/user/AdminUserLifecycleCard.tsx";
import AdminUserConfigurationCard from "app/admin/features/user/AdminUserConfigurationCard.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import AdminUserDeleteButton from "app/admin/features/user/AdminUserDeleteButton.tsx";

const AdminUserDetailsPage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    const navigate = useNavigate();

    const user = useGetOneUserById(userId);
    if (!user) {
        return <ErrorPage />
    }

    const onConfirmDelete = () => {
        navigate(adminRoutes.user.list);
    }

    return (
        <AdminLayout>
            <>
                <EditButton routeToEditPage={adminRoutes.user.edit(user.id)}/>
                <AdminUserDeleteButton userId={user.id} callbackFunction={onConfirmDelete}/>
            </>

            <AdminUserPreviewCard user={user} displayReadActions={false}/>

            <div className={"columns"}>
                <div className={"column half-width"}>
                    <AdminUserLifecycleCard user={user}/>
                </div>

                <div className={"column half-width"}>
                    <AdminUserConfigurationCard user={user}/>
                </div>
            </div>
        </AdminLayout>
    );
}

export default AdminUserDetailsPage;