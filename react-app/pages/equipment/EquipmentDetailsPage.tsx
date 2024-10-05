import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import EquipmentPreviewCard from "../../features/equipment/EquipmentPreviewCard.tsx";
import {useParams} from "react-router-dom";
import useGetOneEquipmentById from "../../hooks/equipment/useGetOneEquipmentById.tsx";
import ErrorPage from "../ErrorPage.tsx";

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