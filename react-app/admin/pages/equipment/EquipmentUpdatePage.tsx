import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import useGetOneEquipmentById from "app/common/hooks/equipment/useGetOneEquipmentById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import EquipmentUpdateForm from "app/admin/features/equipment/EquipmentUpdateForm.tsx";

const EquipmentUpdatePage: React.FC = () => {
    const { equipmentId } = useParams<{ equipmentId: string }>();
    const equipment = useGetOneEquipmentById(equipmentId);
    if (!equipment) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <h3>{equipment.name} #{equipment.id}</h3>
            <EquipmentUpdateForm equipment={equipment} />
        </AdminLayout>
    )
}

export default EquipmentUpdatePage;