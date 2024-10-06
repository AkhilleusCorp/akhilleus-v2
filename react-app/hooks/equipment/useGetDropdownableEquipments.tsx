import {useEffect, useState} from "react";
import EquipmentApiGateway from "../../services/api/gateway/EquipmentApiGateway.tsx";
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";

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