import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import MovementApiGateway from "../../services/api/gateway/MovementApiGateway.tsx";
import MovementDTO from "../../services/api/dtos/MovementDTO.tsx";
import {SelectChangeEvent, TextField} from "@mui/material";
import SelectInput from "../../components/input/SelectInput.tsx";
import MultiSelectInput from "../../components/input/MultiSelectInput.tsx";
import useGetDropdownableEquipments from "../../hooks/equipment/useGetDropdownableEquipments.tsx";
import useGetDropdownableMuscles from "../../hooks/muscle/useGetDropdownableMuscles.tsx";

type MovementUpdateFormType = {
    movement: MovementDTO,
}

const MovementUpdateForm: React.FC<MovementUpdateFormType> = ({movement}) => {
    const navigate = useNavigate();
    const [movementUpdated, setMovementUpdated] = useState<MovementDTO>(movement);
    const equipments = useGetDropdownableEquipments();
    const muscles = useGetDropdownableMuscles();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMovementUpdated({
            ...movementUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent<string[]>|SelectChangeEvent) => {
        setMovementUpdated({
            ...movementUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            await MovementApiGateway.updateMovement(movement.id, movementUpdated);
            navigate(websiteRoutes.movement.details(movement.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                           name={"name"} value={movementUpdated.name} onChange={handleInputChange}/>
            </div>

            <div>
                <SelectInput label="Primary muscle" name={"primaryMuscle"} value={movementUpdated.primaryMuscle.id as string}
                             options={muscles} required={true} onSelectChange={handleSelectChange}/>
            </div>

            <div>
                <MultiSelectInput name={"auxiliaryMuscles"} label={"Auxiliary muscles"}
                                  value={movementUpdated.auxiliaryMuscles.map((muscle) => {return muscle.id as string})} required={false} options={muscles} onSelectChange={handleSelectChange}/>
            </div>

            <div>
                <MultiSelectInput name={"equipments"} label={"Equipment"}
                                  value={movementUpdated.equipments.map((equipment) => {return equipment.id as string})} required={false} options={equipments} onSelectChange={handleSelectChange}/>
            </div>
        </SaveForm>
    )
}

export default MovementUpdateForm;