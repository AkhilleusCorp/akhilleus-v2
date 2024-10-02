import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UserPreviewCard from "../../widget/user/UserPreviewCard.tsx";
import {useParams, useNavigate} from "react-router-dom";
import ErrorPage from "../ErrorPage.tsx";
import useGetOneUserById from "../../hooks/user/useGetOneUserById.tsx";
import UserDeleteButton from "../../widget/user/UserDeleteButton.tsx";
import EditButton from "../../widget/common/button/EditButton.tsx";
import websiteRoutes from "../../config/routes/websiteRoutes.tsx";
import UserLifecycleCard from "../../widget/user/UserLifecycleCard.tsx";
import UserConfigurationCard from "../../widget/user/UserConfigurationCard.tsx";

const UserDetailsPage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    const navigate = useNavigate();

    const user = useGetOneUserById(userId);
    if (!user) {
        return <ErrorPage />
    }

    const onConfirmDelete = (userId: number) => {
        console.log(userId);
        navigate(websiteRoutes.user.list);
    }

    return (
        <AdminLayout>
            <div className={"text-align-right margin-bottom-s"}>
                <EditButton routeToEditPage={websiteRoutes.user.edit(user.id)}/>
                <UserDeleteButton userId={user.id} callbackFunction={onConfirmDelete}/>
            </div>
            <UserPreviewCard user={user} displayActions={false}/>

            <div className={"columns"}>
                <div className={"column half-width"}>
                    <UserLifecycleCard user={user}/>
                </div>

                <div className={"column half-width"}>
                    <UserConfigurationCard user={user}/>
                </div>
            </div>
        </AdminLayout>
    );
}

export default UserDetailsPage;