import {useEffect, useState} from "react";
import IndexedArray from "app/utils/interfaces/IndexedArray.tsx";
import EquipmentApiGateway from "app/services/api/gateway/EquipmentApiGateway.tsx";

function useGetDropdownableEquipments(): IndexedArray {
    const [equipments, setEquipments] = useState<IndexedArray>({});
    useEffect(() => {
        const fetchEquipments = async () => {
            const equipments= await EquipmentApiGateway.getDropdownableEquipments();
            setEquipments(equipments);
        }

        fetchEquipments();
    }, []);

    return equipments;
}

export default useGetDropdownableEquipments;