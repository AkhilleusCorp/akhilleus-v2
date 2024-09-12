import axios from "axios";

const deleteUser = async (userId: number) => {
    await axios.delete(`https://api.akhilleus.com:8000/api/users/${userId}`)
}

export default deleteUser;