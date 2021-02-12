<template>
  <div class="item">
    <input
      class="chkbx"
      type="checkbox"
      @change="updateCheck()"
      v-model="item.completed"
    />
    <span :class="[item.completed ? 'completed' : '', 'itemText' ]">{{ item.name }}</span>
    <button @click="removeItem()" class="trashcan">
      <font-awesome-icon icon="trash" />
    </button>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  props: ['item'],
  data: function (){
    return {

    }
  },
  methods: {
    updateCheck: function() {
      axios.put('api/item/'+ this.item.id, {
        item: this.item
      }).
      then(res => {
        if(res.status == 200){
          this.$emit('itemChanged');
        }
      })
      .catch(err => {
        console.log(err);
      });
    },
    removeItem: function() {
      axios.delete('api/item/'+this.item.id)
        .then(res => {
          if (res.status == 200){
            this.$emit('itemChanged');
          }
        })
        .catch(err => {
          console.log(err);
        })
    }
  }
}
</script>
<style scoped>
.completed {
  text-decoration: line-through;
  color: #999999;
}

.itemText {
  width: 100%;
  margin-left: 20px;
}

.item {
  display: flex;
  justify-content: center;
  align-items: center;
}

.trashcan {
  cursor: pointer;
  border: none;
  color: #FF0000;
  outline: none;
}
.chkbx {
  cursor: pointer;
}
</style>
