import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import MovementApiGateway from "../../services/api/gateway/MovementApiGateway.tsx";
import {SelectChangeEvent, TextField} from "@mui/material";
import MultiSelectInput from "../../components/input/MultiSelectInput.tsx";
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";

type MovementCreateFormType = {
    name: string;
}

const MovementCreateForm: React.FC = () => {
    const [movementCreate, setMovementCreate] = useState<MovementCreateFormType>({name: ''});
    const navigate = useNavigate();

    const options: IndexedArray = {
        '1': 'barbell',
        '2': 'bench',
        '3': 'cable',
        '4': 'dumbbell',
    }

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMovementCreate({
            ...movementCreate,
            [event.target.name]: event.target.value
        });
    }
    const handleSelectChange = (event: SelectChangeEvent<string[]>) => {
        setMovementCreate({
            ...movementCreate,
            [event.target.name]: event.target.value
        });
    }


    const handleSubmit = async () => {
        try {
            const movement = await MovementApiGateway.createMovement(movementCreate);
            navigate(websiteRoutes.movement.details(movement.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Name" variant="outlined" size="small"
                           name={"name"} required={true} onChange={handleInputChange}/>
            </div>

            <div>
                <TextField id="outlined-basic" label="Primary muscle" variant="outlined" size="small"
                           name={"primaryMuscle"} required={true} onChange={handleInputChange}/>
            </div>

            <div>
                <TextField id="outlined-basic" label="Auxiliary muscles" variant="outlined" size="small"
                           name={"auxiliaryMuscles"} onChange={handleInputChange}/>
            </div>

            <div>
                <MultiSelectInput name={"equipments"} label={"Equipment"}
                           value={[]} required={false} options={options} onSelectChange={handleSelectChange}/>
            </div>
        </SaveForm>
    )
}

export default MovementCreateForm;