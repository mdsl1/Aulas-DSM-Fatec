import { useState } from "react";
import { View, TextInput, Button, Alert } from "react-native";
import { styles } from './styles';


export function ConceptForm({add} : any) {
    const [icon, setIcon] = useState('');
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');

    function saveConcept() {

        if(icon === '' || title === '' || description === '') {
            Alert.alert('Conceito Vazio', "Preencha todos os campos");
        }
        
        add(icon, title, description);


        setIcon('');
        setTitle('');
        setDescription('');
    }

    return (
        <View>

            <TextInput style={styles.input} placeholder="Icone" value={icon} onChangeText={setIcon} />
            <TextInput style={styles.input} placeholder="Título" value={title} onChangeText={setTitle} />
            <TextInput style={[styles.input, styles.lastInput]} placeholder="Descrição" value={description} onChangeText={setDescription} />

            <Button title='Adicionar' onPress={saveConcept} />

        </View>
    );
}