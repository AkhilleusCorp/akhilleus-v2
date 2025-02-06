import React from 'react';
import {useNavigate, useParams} from "react-router-dom";
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import EquipmentPreviewCard from "app/common/features/equipment/EquipmentPreviewCard.tsx";
import useGetOneEquipmentById from "app/common/hooks/equipment/useGetOneEquipmentById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import AdminEquipmentDeleteButton from "app/admin/features/equipment/AdminEquipmentDeleteButton.tsx";

const AdminEquipmentDetailsPage: React.FC = () => {
    const { equipmentId } = useParams<{ equipmentId: string }>();
    const equipment = useGetOneEquipmentById(equipmentId);
    const navigate = useNavigate();

    if (!equipment) {
        return <ErrorPage />
    }

    const onConfirmDelete = () => {
        navigate(adminRoutes.equipment.list);
    }
    
    return (
        <AdminLayout>
            <>
                <EditButton routeToEditPage={adminRoutes.equipment.edit(equipment.id)} />
                <AdminEquipmentDeleteButton equipmentId={equipment.id} callbackFunction={onConfirmDelete} />
            </>
            <EquipmentPreviewCard equipment={equipment} />
        </AdminLayout>
    );
}

export default AdminEquipmentDetailsPage;