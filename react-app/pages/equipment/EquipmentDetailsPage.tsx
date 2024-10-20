import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import EquipmentPreviewCard from "app/features/equipment/EquipmentPreviewCard.tsx";
import {useParams} from "react-router-dom";
import useGetOneEquipmentById from "app/hooks/equipment/useGetOneEquipmentById.tsx";
import ErrorPage from "app/pages/ErrorPage.tsx";

const EquipmentDetailsPage: React.FC = () => {
    const { equipmentId } = useParams<{ equipmentId: string }>();

    const equipment = useGetOneEquipmentById(equipmentId);
    
    if (!equipment) {
        return <ErrorPage />
    }
    
    return (
        <AdminLayout>
            <EquipmentPreviewCard equipment={equipment} displayReadActions={false} displayWriteActions={true}/>
        </AdminLayout>
    );
}

export default EquipmentDetailsPage;