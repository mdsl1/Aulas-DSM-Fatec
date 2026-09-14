import { StyleSheet } from "react-native";

export const styles = StyleSheet.create({
    cartao: {
        alignItems: 'center',
        backgroundColor: '#d1f3ff',
        borderColor: '#00f',
        borderRadius: 16,
        borderWidth: 1,
        flexDirection: 'row',
        gap: 14,
        padding: 16,
        marginVertical: 10, 
        maxWidth: 300
    },
    cartaoWide: {
        alignItems: 'flex-start',
        flex: 1,
        flexDirection: 'column'
    },
    containerIcone: {
        alignItems: 'center',
        backgroundColor: '#a0e1f9',
        borderColor: '#00f',
        borderWidth: 1,
        borderRadius: 50,
        padding: 5
    },
    icone: {
        fontSize: 25
    },
    titulo: {
        fontSize: 20,
        fontWeight: 'bold',
        color: '#000091'
    },
    descricao: {
        marginTop: 5,
        color: '#3b3b3b',
        width: 200
    }
});